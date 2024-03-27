from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

from pypdf import PdfReader, PdfWriter, PageObject
from pypdf.annotations import FreeText, Line, Link, Popup, Text

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

    # Author
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': 'Title',
            '/Author': seq,
            '/Subject': 'Subject',
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/author" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Author", seq)
        count += 1

    # Title
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': seq,
            '/Author': 'Author',
            '/Subject': 'Subject',
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/title" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Title", seq)
        count += 1

    # Subject
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': 'Title',
            '/Author': 'Author',
            '/Subject': seq,
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/subject" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Subject", seq)
        count += 1

    # Creator
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': 'Title',
            '/Author': 'Author',
            '/Subject': 'Subject',
            '/Creator': seq
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/creator" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Creator", seq)
        count += 1

    # FreeText
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = FreeText(
            text=seq,
            rect=(50, 550, 200, 650),
            font="Arial",
            bold=True,
            italic=True,
            font_size="20pt",
            font_color="00ff00",
            border_color="0000ff",
            background_color="cdcdcd",
        )
        writer.add_annotation(page_number=0, annotation=annotation)

        # Write the annotated file to disk
        with open("/pdfs/freetext" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("FreeText", seq)
        count += 1

    # Line
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = Line(
            text=seq,
            rect=(50, 550, 200, 650),
            p1=(50, 550),
            p2=(200, 650),
        )
        writer.add_annotation(page_number=0, annotation=annotation)

        # Write the annotated file to disk
        with open("/pdfs/line" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Line", seq)
        count += 1

    # Text Annotation
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        text_annotation = writer.add_annotation(
            0,
            Text(
                text=seq,
                rect=(50, 550, 200, 650),
                open=True,
            ),
        )

        popup_annotation = Popup(
            rect=(50, 550, 200, 650),
            open=True,
            parent=text_annotation,  # use the output of add_annotation
        )

        # Write the annotated file to disk
        with open("/pdfs/textannot" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("TextAnnotation", seq)
        count += 1

    # Link
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = Link(
            rect=(50, 550, 200, 650),
            url=seq,
        )
        writer.add_annotation(page_number=0, annotation=annotation)

        # Write the annotated file to disk
        with open("/pdfs/link" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("Link", seq)
        count += 1

    # URI
    count = 0
    for seq in os_commands:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        writer.add_uri(page_number=0, uri=seq, rect=(50, 550, 200, 650))

        # Write the annotated file to disk
        with open("/pdfs/uri" + str(count) + ".pdf", "wb") as fp:
            writer.write(fp)

        ret += check_test_file("URI", seq)
        count += 1

    return HttpResponse(ret)
