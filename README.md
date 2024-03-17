# pdf-library-assessment
MS Capstone 

Make sure permissions of PHP directory is 777.
chmod -R 777 .

echo -e "\nendstream\nendobj\nxhref\n0 14\n0000000000 65535 f\n0000000831 00000 n\n0000001964 00000 n\ntrailer\n<< /Size 14 /Root 13 0 R /Info 11 0 R /ID [ <23ee55ef3d48c3b70045b0c2b153d244> <23ee55ef3d48c3b70045b0c2b153d244> ] >>\nstartxref\n7445\n%%EOF" >> xref.jpeg
echo -e "\nendstream\nendobj\n1 0 obj\n<<" >> arrowbreak.jpeg
echo -e "\nendstream\n1 0 obj\n<<" >> endstreamonly.png


TCPDF
- Likely no Adobe Illustrator Image File ImageEps()
- Far less Text() objects than expected. Many streams
- XML stream at the bottom escapes special characters for XML documents, but not special characters for terminating streams
- Wanted to check different Output types EX: I, F. But there are limitations preventing more than one I in a script

Want to play around with Fonts to see if multibyte characters can be manipulated into escape sequences

Assuming that compression will always be enabled. (doesn't make much sense for authors to disable it)


Try adding payload with hexdeciminal specification

Reliance on PDF reader security to avoid escape sequences from triggering early

Many times the tested function appends the new object at the end of the PDF which hinders testing since we'd like the object being tested in the forefront so it breaks later objects

Python Payloads could not have 0A normally, instead replaced with hex variant

Move some comparisons in literature review to methodology. Went too overboard in literature view (too good

PikePDF was originallly used for Annotation testing but was found to modify Unicocde)

sudo apt install maven