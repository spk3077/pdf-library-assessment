from django.shortcuts import render
from django.http import HttpResponse

import os

from pypdf import PdfReader, PdfWriter, PageObject
from pypdf.annotations import FreeText, Line, Link, Popup, Text

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
    count = 0
    for seq in escape_seq:
        pdf_writer = PdfWriter()
        pdf_writer.add_blank_page(width=210, height=297)

        metadata = {
            '/Title': 'Title',
            '/Author': 'Author',
            '/Subject': 'Subject',
            '/Creator': 'Creator'
        }
        pdf_writer.add_metadata(metadata)

        # Test
        # Read the existing PDF
        existing_pdf = PdfReader(open("original.pdf", "rb"))
        output = PdfFileWriter()

        # Add the text (which is the new pdf) on the existing page
        page = existing_pdf.getPage(0)
        page.mergePage(new_pdf.getPage(0))
        output.addPage(page)















        # Add the text object to the page
        page_object.add_text(text_object)

        # Write the annotated file to disk
        with open("/pdfs/author.pdf", "wb") as fp:
            pdf_writer.write(fp)
        
        count += 1


        # Create the annotation and add it
        annotation = FreeText(
            text="Hello World\nThis is the second line!",
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

    pdf_path = os.path.join(RESOURCE_ROOT, "crazyones.pdf")
    reader = PdfReader(pdf_path)
    page = reader.pages[0]
    writer = PdfWriter()
    writer.add_page(page)

    # Add the line
    annotation = Line(
        text="Hello World\nLine2",
        rect=(50, 550, 200, 650),
        p1=(50, 550),
        p2=(200, 650),
    )
    writer.add_annotation(page_number=0, annotation=annotation)

    # Arrange
    writer = PdfWriter()
    writer.append(os.path.join(RESOURCE_ROOT, "crazyones.pdf"), [0])

    # Act
    text_annotation = writer.add_annotation(
        0,
        Text(
            text="Hello World\nThis is the second line!",
            rect=(50, 550, 200, 650),
            open=True,
        ),
    )

    popup_annotation = Popup(
        rect=(50, 550, 200, 650),
        open=True,
        parent=text_annotation,  # use the output of add_annotation
    )

    pdf_path = os.path.join(RESOURCE_ROOT, "crazyones.pdf")
    reader = PdfReader(pdf_path)
    page = reader.pages[0]
    writer = PdfWriter()
    writer.add_page(page)

    # Add the line
    annotation = Link(
        rect=(50, 550, 200, 650),
        url="https://martin-thoma.com/",
    )
    pdf_writer.add_uri()
    writer.add_annotation(page_number=0, annotation=annotation)

    # Write the annotated file to disk
    with open("annotated-pdf.pdf", "wb") as fp:
        writer.write(fp)

    return HttpResponse("INJECTION")
