from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import pikepdf
from pikepdf import Array, Pdf, Stream

sys.path.insert(0, "/usr/src/app")
from py_payloads import os_commands

def check_test_file(endpoint: str, command: str) -> str:
    if os.path.exists('/usr/src/app/test'):
        os.unlink('/usr/src/app/test')
        print("Endpoint: " + endpoint + " Command: " + command)
        return "Endpoint: " + endpoint + " Command: " + command + " | "
    else:
        return ""


def index(request):
    ret: str = "OS INJECTION: "
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
    count: int = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = seq

        pdf.save("/pdfs/author" + str(count) + ".pdf")
        ret += check_test_file("Author", seq)
        count += 1

    # Title
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['dc:title'] = seq

        pdf.save("/pdfs/title" + str(count) + ".pdf")
        ret += check_test_file("Title", seq)
        count += 1

    # Creator
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Creator'] = seq

        pdf.save("/pdfs/creator" + str(count) + ".pdf")
        ret += check_test_file("Creator", seq)
        count += 1

    # Producer
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Producer'] = seq

        pdf.save("/pdfs/producer" + str(count) + ".pdf")
        ret += check_test_file("Producer", seq)
        count += 1

    # Keywords
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Keywords'] = seq

        pdf.save("/pdfs/keywords" + str(count) + ".pdf")
        ret += check_test_file("Keywords", seq)
        count += 1

    # Text
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()
      
        new_content = Stream(pdf, b'BT /F1 12 Tf 100 100 Td (' + seq.encode("utf-8") + b') Tj ET')
        pdf.pages[0].contents_add(new_content)

        pdf.save("/pdfs/text" + str(count) + ".pdf")
        ret += check_test_file("Text", seq)
        count += 1

    # URI
    count = 0
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()
        link_annotation = pikepdf.Dictionary(
            Type=pikepdf.Name('/Annot'),
            Subtype=pikepdf.Name('/Link'),
            Rect=[0, 0, 100, 100],
            Border=[0, 0, 1],
            A=pikepdf.Dictionary(
                S=pikepdf.Name('/URI'),
                URI=seq
            )
        )

        pdf.pages[0]['/Annots'] = Array()
        pdf.pages[0]['/Annots'].append(link_annotation)

        pdf.save("/pdfs/uri" + str(count) + ".pdf")
        ret += check_test_file("URI", seq)
        count += 1

    # Output
    for seq in os_commands:
        pdf = Pdf.new()
        pdf.add_blank_page()

        pdf.save("/pdfs/output" + seq)
        ret += check_test_file("Output", seq)

    return HttpResponse(ret)
