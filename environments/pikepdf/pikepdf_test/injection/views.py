from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import pikepdf
from pikepdf import Array, Pdf, Stream

sys.path.insert(0, "/usr/src/app")
from py_payloads import escape_seq

def index(request):
    # Delete existing PDFs
    file_paths = []  # List to store file paths
    for root, directories, files in os.walk("/pdfs/"):
        for filename in files:
            filepath = os.path.join(root, filename)
            file_paths.append(filepath)

    for pdf_path in file_paths:
        os.unlink(pdf_path)

    pikepdf.settings.set_flate_compression_level(0)

    # Author
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = seq
        
        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/author" + str(count) + ".pdf")
        count += 1

    # Title
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['dc:title'] = seq
        
        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/title" + str(count) + ".pdf")
        count += 1

    # Author
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Creator'] = seq

        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/creator" + str(count) + ".pdf")
        count += 1

    # Producer
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Producer'] = seq

        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/producer" + str(count) + ".pdf")
        count += 1

    # Keywords
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Keywords'] = seq

        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/keywords" + str(count) + ".pdf")
        count += 1

    # Text
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()
      
        new_content = Stream(pdf, b'BT /F1 12 Tf 100 100 Td (' + seq.encode("utf-8") + b') Tj ET')
        pdf.pages[0].contents_add(new_content)

        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/text" + str(count) + ".pdf")
        count += 1

    # URI
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()
        link_annotation = pikepdf.Dictionary(
            Type=pikepdf.Name('/Annot'),
            Subtype=pikepdf.Name('/Link'),
            Rect=[0, 0, 100, 100],
            Border=[0, 0, 1],
            A=pikepdf.Dictionary(
                S=pikepdf.Name('/URI'),
                URI="seq"
            )
        )

        pdf.pages[0]['/Annots'] = Array()
        pdf.pages[0]['/Annots'].append(link_annotation)

        # Test
        new_content = Stream(pdf, b'BT /F1 12 Tf 50 50 Td (DOGTEST) Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/uri" + str(count) + ".pdf")
        count += 1

    return HttpResponse("INJECTION")