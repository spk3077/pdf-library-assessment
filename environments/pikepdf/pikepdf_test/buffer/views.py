from django.shortcuts import render
from django.http import HttpResponse

import os

import pikepdf
from pikepdf import Array, Pdf, Stream

MAX_COUNT: int = 10000

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
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = "V" * i

        pdf.save("/pdfs/author.pdf")
        i += 1

    # Title
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['dc:title'] = "V" * i

        pdf.save("/pdfs/title.pdf")
        i += 1

    # Creator
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Creator'] = "V" * i

        pdf.save("/pdfs/creator.pdf")
        i += 1

    # Producer
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Producer'] = "V" * i

        pdf.save("/pdfs/producer.pdf")
        i += 1

    # Keywords
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Keywords'] = "V" * i

        pdf.save("/pdfs/keywords.pdf")
        i += 1

    # Text
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()
      
        new_content = Stream(pdf, b'BT /F1 12 Tf 100 100 Td (' + ("V" * i).encode("utf-8") + b') Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/text.pdf")
        i += 1

    # URI
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()
        link_annotation = pikepdf.Dictionary(
            Type=pikepdf.Name('/Annot'),
            Subtype=pikepdf.Name('/Link'),
            Rect=[0, 0, 100, 100],
            Border=[0, 0, 1],
            A=pikepdf.Dictionary(
                S=pikepdf.Name('/URI'),
                URI="V" * i
            )
        )

        pdf.pages[0]['/Annots'] = Array()
        pdf.pages[0]['/Annots'].append(link_annotation)

        pdf.save("/pdfs/uri.pdf")
        i += 1

    # Output
    i: int = 1
    while i < MAX_COUNT:
        pdf = Pdf.new()
        pdf.add_blank_page()

        pdf.save("/pdfs/output" + "V" * i)
        i += 1

    return HttpResponse("BUFFER")
