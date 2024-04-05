from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import fitz

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

    # Author
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": seq,
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/author" + str(count) + ".pdf")
        count += 1

    # Title
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": seq,
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/title" + str(count) + ".pdf")
        count += 1

    # Subject
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": seq,
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/subject" + str(count) + ".pdf")
        count += 1

    # Keywords
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": seq,
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/keywords" + str(count) + ".pdf")
        count += 1

    # Creator
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": seq,
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/creator" + str(count) + ".pdf")
        count += 1

    # Producer
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": seq
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/producer" + str(count) + ".pdf")
        count += 1

    # Text
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "DOGTEST",
        }
        doc.set_metadata(new_metadata)
        page.insert_text((50, 100), seq, fontname="helv", fontsize=12)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/text" + str(count) + ".pdf")
        count += 1

    # HTMLbox
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "DOGTEST",
        }
        doc.set_metadata(new_metadata)
        page.insert_htmlbox(fitz.Rect(0,0,50,50), seq, css="* {font-family: sans-serif;font-size:14px;}")
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/htmlbox" + str(count) + ".pdf")
        count += 1

    # Link
    count = 0
    for seq in escape_seq:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "DOGTEST",
        }
        doc.set_metadata(new_metadata)
        link = {
            "kind": fitz.LINK_URI,
            "uri": seq,
            "from": fitz.Rect(0,0,50,50)
        }
        page.insert_link(link)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/link" + str(count) + ".pdf")
        count += 1

    # Image
    file_paths = []  # List to store file paths
    for root, directories, files in os.walk("/images/"):
        for filename in files:
            filepath = os.path.join(root, filename)
            file_paths.append(filepath)

    count = 0
    for image_path in file_paths:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "DOGTEST",
        }
        doc.set_metadata(new_metadata)
        page.insert_image(fitz.Rect(0,0,50,50), filename=image_path)
        page.insert_text((50, 100), "DOGTEST", fontname="helv", fontsize=12)
        doc.save("/pdfs/image" + str(count) + ".pdf")
        count += 1

    return HttpResponse("INJECTION")
