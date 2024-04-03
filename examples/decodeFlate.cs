// File: index.php
// Assignment: MS Capstone
// Lanuguage: C#
// Author: Sean Kells <spk3077@rit.edu>
// Description: Decode DEFLATE streams present within PDF

// mcs -out:decodeFlate.exe decodeFlate.cs
// mono decodeFlate.exe
using System;
using System.Text;
using System.IO;
using System.IO.Compression;
using System.Linq;

namespace main
{
    class Program
    {

        // Decipher what endstream would decompress into for DeFlate
        // Takes header of stream and the binary for 'endstream'
        // Did not successfully decompress
        public static void deflate_endstream(){
            byte[] header = parse_pdf("", 535, 4);
            byte[] endstream = parse_pdf("", 740, 9);
            byte[] ret = new byte[header.Length + endstream.Length];
            System.Buffer.BlockCopy(header, 0, ret, 0, header.Length);
            System.Buffer.BlockCopy(endstream, 0, ret, header.Length, endstream.Length);
            Console.WriteLine(Encoding.UTF8.GetString(ret));
            Console.WriteLine(decompress(ret));
        }

        public static long[] find_position(Stream stream, byte[] byteSequence) {
            long[] ret = new long[50];
            if (byteSequence.Length > stream.Length)
                return ret;

            byte[] buffer = new byte[byteSequence.Length];
            using (BufferedStream bufStream = new BufferedStream(stream, byteSequence.Length))
            {
                int count = 0;
                while ((bufStream.Read(buffer, 0, byteSequence.Length)) == byteSequence.Length)
                {
                    if (byteSequence.SequenceEqual(buffer)) {
                        ret[count] = bufStream.Position - byteSequence.Length;
                        count++;
                    }
                    else {
                        bufStream.Position -= byteSequence.Length - pad_left_sequence(buffer, byteSequence);
                    }
                }
            }

            return ret;
        }

        private static int pad_left_sequence(byte[] bytes, byte[] seqBytes) {
            int i = 1;
            while (i < bytes.Length)
            {
                int n = bytes.Length - i;
                byte[] aux1 = new byte[n];
                byte[] aux2 = new byte[n];
                Array.Copy(bytes, i, aux1, 0, n);
                Array.Copy(seqBytes, aux2, n);
                if (aux1.SequenceEqual(aux2))
                    return i;
                i++;
            }
            return i;
        }

        static byte[] parse_pdf(string file, int start, int size){
            var data = new byte[size];
            int actualRead;

            using (FileStream fs = new FileStream(file, FileMode.Open)) {
                // Starting offset
                fs.Position = start; 
                actualRead = 0;
                do {
                    actualRead += fs.Read(data, actualRead, size-actualRead);
                } while (actualRead != size && fs.Position < fs.Length);

            return data;  
            }
        }


        static string decompress(byte[] input){
            byte[] cutinput = new byte[input.Length - 2];
            Array.Copy(input, 2, cutinput, 0, cutinput.Length);

            var stream = new MemoryStream();

            using (var compressStream = new MemoryStream(cutinput))
            using (var decompressor = new DeflateStream(compressStream, CompressionMode.Decompress))
                decompressor.CopyTo(stream);

            return Encoding.Default.GetString(stream.ToArray());
        }


        public static void Main() {
            // '<< stream' binary array
            // string TCPDF = "./decodeFlate_tcpdf.pdf";
            // string DOMPDF = "./decodeFlate_dompdf.pdf";
            string ITEXT = "./decodeFlate_itext.pdf";

            string SEARCHED_PDF = "./div7.pdf";

            // For TCPDF
            // byte[] start_stream_seq = parse_pdf(TCPDF, 525, 9);
            // byte[] edit_stream_seq = parse_pdf(TCPDF, 740, 9);
            // int START_DISTANCE = 10;

            // For DOMPDF
            // byte[] start_stream_seq = parse_pdf(DOMPDF, 609, 9);
            // byte[] edit_stream_seq = parse_pdf(DOMPDF, 721, 9);
            // int START_DISTANCE = 10;

            // For ITEXT
            byte[] start_stream_seq = parse_pdf(ITEXT, 54, 8);
            byte[] edit_stream_seq = parse_pdf(ITEXT, 138, 9);
            int START_DISTANCE = 9;

            Console.WriteLine(Encoding.UTF8.GetString(start_stream_seq));
            Console.WriteLine(Encoding.UTF8.GetString(edit_stream_seq));

            long[] start_stream_pos;
            long[] end_stream_pos;
            using (FileStream fs = new FileStream(SEARCHED_PDF, FileMode.Open)) {
                start_stream_pos = find_position(fs, start_stream_seq);
            }
            using (FileStream fs = new FileStream(SEARCHED_PDF, FileMode.Open)) {
                end_stream_pos = find_position(fs, edit_stream_seq);
            }

            if (start_stream_pos.Length != end_stream_pos.Length) {
                Console.WriteLine("Unequal # of start streams and end streams");
                return;
            }

            var stream_start_end = start_stream_pos.Zip(end_stream_pos, (s, e) => new { Start = s, End = e });
            foreach(var se in stream_start_end) {
                if (se.Start == 0)
                    continue;
                Console.WriteLine("BEGIN STREAM");
                try {
                    Console.WriteLine(decompress(parse_pdf(SEARCHED_PDF, unchecked((int)se.Start) + START_DISTANCE, unchecked((int)se.End) - 1)));
                }
                catch (Exception) {
                    Console.WriteLine(se.Start);
                    Console.WriteLine(se.End);
                    Console.WriteLine("INVALID STREAM DATA");
                }
                Console.WriteLine("END STREAM\n");
                Console.WriteLine("--------------------------------------------------------------------------");
            }
        
        // byte[] ret = parse_pdf(SEARCHED_PDF, 2568, 1000);
        // Console.WriteLine(Encoding.UTF8.GetString(ret));
        }
    }
}
