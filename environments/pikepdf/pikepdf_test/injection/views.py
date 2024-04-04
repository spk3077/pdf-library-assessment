from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import pikepdf
from pikepdf import Array, Pdf, Stream

from io import BytesIO
from reportlab.pdfgen import canvas

sys.path.insert(0, "/usr/src/app")
from py_payloads import escape_seq

def generate_stamp(msg, xy):
    x, y = xy
    buf = BytesIO()
    c = canvas.Canvas(buf, bottomup=0)
    c.setFontSize(16)
    c.setFillColorCMYK(0, 0, 0, 0, alpha=0.7)
    c.rect(194, 5, 117, 17, stroke=1, fill=1)
    c.setFillColorCMYK(0, 0, 0, 100, alpha=0.7)
    c.drawString(x, y, msg)
    c.save()
    buf.seek(0)
    return buf

def index(request):
    # Delete existing PDFs
    file_paths = []  # List to store file paths
    for root, directories, files in os.walk("/pdfs/"):
        for filename in files:
            filepath = os.path.join(root, filename)
            file_paths.append(filepath)

    for pdf_path in file_paths:
        os.unlink(pdf_path)

    # pikepdf.settings.set_flate_compression_level(0)

    # Author
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = seq

        pdf.save("/pdfs/author" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/author" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/author" + str(count) + ".pdf")
        count += 1

    # Title
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['dc:title'] = seq
      
        pdf.save("/pdfs/title" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/title" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/title" + str(count) + ".pdf")
        count += 1

    # Creator
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Creator'] = seq

        pdf.save("/pdfs/creator" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/creator" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/creator" + str(count) + ".pdf")
        count += 1

    # Producer
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Producer'] = seq

        pdf.save("/pdfs/producer" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/producer" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/producer" + str(count) + ".pdf")
        count += 1

    # Keywords
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Keywords'] = seq

        pdf.save("/pdfs/keywords" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/keywords" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/keywords" + str(count) + ".pdf")
        count += 1

    # Text
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = "TEST"

        pdf.save("/pdfs/text" + str(count) + ".pdf")

        stamp = generate_stamp(seq, (200, 20))
        with pikepdf.open("/pdfs/text" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/text" + str(count) + ".pdf")

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/text" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/text" + str(count) + ".pdf")
        count += 1

    # URI
    count = 0
    for seq in escape_seq:
        pdf = Pdf.new()
        pdf.add_blank_page()

        with pdf.open_metadata() as meta:
            meta['pdf:Author'] = "TEST"
        
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

        # Test
        stamp = generate_stamp("DOGTEST", (200, 20))
        with pikepdf.open("/pdfs/uri" + str(count) + ".pdf", allow_overwriting_input=True) as pdf_orig, pikepdf.open(stamp) as pdf_text:
            formx_text = pdf_orig.copy_foreign(pdf_text.pages[0].as_form_xobject())
            
            for i in range(len(pdf_orig.pages)):
                formx_page = pdf_orig.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf_orig.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)
                
                pdf_orig.pages[i].contents_add(stamp_text)

            pdf_orig.save("/pdfs/uri" + str(count) + ".pdf")
        count += 1

    return HttpResponse("INJECTION")