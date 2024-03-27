from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

from pypdf import PdfReader, PdfWriter, PageObject
from pypdf.annotations import FreeText, Line, Link, Popup, Text

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

    # Author
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': 'Title',
            '/Author': "V" * i,
            '/Subject': 'Subject',
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/author.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Title
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': "V" * i,
            '/Author': 'Author',
            '/Subject': 'Subject',
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/title.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Subject
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)
        metadata = {
            '/Title': 'Title',
            '/Author': 'Author',
            '/Subject': "V" * i,
            '/Creator': 'Creator'
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/subject.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Creator
    i: int = 1
    while i < MAX_COUNT:
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
            '/Creator': "V" * i
        }
        writer.add_metadata(metadata)

        # Write the annotated file to disk
        with open("/pdfs/creator.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # FreeText
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = FreeText(
            text="V" * i,
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
        with open("/pdfs/freetext.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Line
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = Line(
            text="V" * i,
            rect=(50, 550, 200, 650),
            p1=(50, 550),
            p2=(200, 650),
        )
        writer.add_annotation(page_number=0, annotation=annotation)

        # Write the annotated file to disk
        with open("/pdfs/line.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Text Annotation
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        text_annotation = writer.add_annotation(
            0,
            Text(
                text="V" * i,
                rect=(50, 550, 200, 650),
                open=True,
            ),
        )

        popup_annotation = Popup(
            rect=(50, 550, 200, 650),
            open=True,
            parent=text_annotation,
        )

        # Write the annotated file to disk
        with open("/pdfs/textannot.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # Link
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        annotation = Link(
            rect=(50, 550, 200, 650),
            url="V" * i,
        )
        writer.add_annotation(page_number=0, annotation=annotation)

        # Write the annotated file to disk
        with open("/pdfs/link.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    # URI
    i: int = 1
    while i < MAX_COUNT:
        # Fill the writer with the pages you want
        pdf_path = os.path.join("/usr/src/app/pypdf.pdf")
        reader = PdfReader(pdf_path)
        page = reader.pages[0]
        writer = PdfWriter()
        writer.add_page(page)

        writer.add_uri(page_number=0, uri="V" * i, rect=(50, 550, 200, 650))

        # Write the annotated file to disk
        with open("/pdfs/uri.pdf", "wb") as fp:
            writer.write(fp)

        i += 1

    return HttpResponse("BUFFER")
