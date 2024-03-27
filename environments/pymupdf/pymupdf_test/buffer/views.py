from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import fitz

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
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "V" * i,
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/author.pdf")
        i += 1

    # Title
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "V" * i,
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/title.pdf")
        i += 1

    # Subject
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "V" * i,
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/subject.pdf")
        i += 1

    # Keywords
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "V" * i,
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/keywords.pdf")
        i += 1

    # Creator
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "V" * i,
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/creator.pdf")
        i += 1

    # Producer
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "V" * i
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/producer.pdf")
        i += 1

    # Text
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        page.insert_text((50, 100), "V" * i, fontname="helv", fontsize=12)
        doc.save("/pdfs/text.pdf")
        i += 1

    # HTMLbox
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        page.insert_htmlbox(fitz.Rect(0,0,50,50), "V" * i, css="* {font-family: sans-serif;font-size:14px;}")
        doc.save("/pdfs/htmlbox.pdf")
        i += 1

    # Link
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        link = {
            "kind": fitz.LINK_URI,
            "uri": "V" * i,
            "from": fitz.Rect(0,0,50,50)
        }
        page.insert_link(link)
        doc.save("/pdfs/link.pdf")
        i += 1

    # Output
    i: int = 1
    while i < MAX_COUNT:
        doc = fitz.open()
        page = doc.new_page()
        doc.save("/pdfs/output" + "V" * i)
        i += 1
        
    return HttpResponse("BUFFER")
