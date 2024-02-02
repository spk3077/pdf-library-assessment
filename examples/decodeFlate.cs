// mcs -out:decodeFlate.exe decodeFlate.cs
// mono decodeFlate.exe
using System;
using System.Text;
using System.IO;
using System.IO.Compression;

namespace main
{
    class Program
    { 
        static byte[] parse_pdf(int start, int size){
            var data = new byte[size];
            int actualRead;

            using (FileStream fs = new FileStream("./decodeFlate.pdf", FileMode.Open)) {
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
            byte[] header = parse_pdf(535, 4);
            byte[] endstream = parse_pdf(740, 9);
            byte[] ret = new byte[header.Length + endstream.Length];
            System.Buffer.BlockCopy(header, 0, ret, 0, header.Length);
            System.Buffer.BlockCopy(endstream, 0, ret, header.Length, endstream.Length);
            Console.WriteLine(Encoding.UTF8.GetString(ret));
            Console.WriteLine(decompress(ret));
            
            // Beginning of Stream in PDF
            // byte[] pdfStream = parse_pdf(535, 2);
            // Console.WriteLine(Encoding.UTF8.GetString(pdfStream));
            // Console.WriteLine(decompress(pdfStream));

            // Actual Stream in PDF
            // byte[] pdfStream = parse_pdf(535, 204);
            // Console.WriteLine(Encoding.UTF8.GetString(pdfStream));
            // Console.WriteLine(decompress(pdfStream));
        }
    }
}
