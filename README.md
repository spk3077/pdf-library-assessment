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



Literature Review:
1. https://portswigger.net/research/portable-data-exfiltration
2. https://www.sciencedirect.com/science/article/pii/S0164121210001287?via%3Dihub
3. https://security.snyk.io/vuln/SNYK-RUBY-PDFKIT-2869795
4. 
5. 
6. 
7. 
8. 
9. 
10. 

