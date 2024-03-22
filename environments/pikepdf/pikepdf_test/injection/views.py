from django.shortcuts import render
from django.http import HttpResponse

import sys

import pikepdf
from pikepdf import Pdf
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
    # Text
    count = 0
    for seq in escape_seq:
        stamp = generate_stamp(seq, (200, 20))
        with pikepdf.open(stamp) as pdf_text:
            pdf = Pdf.new()
            pdf.add_blank_page()
            formx_text = pdf.copy_foreign(pdf_text.pages[0].as_form_xobject())

            for i in range(len(pdf.pages)):
                formx_page = pdf.pages[i]
                formx_name = formx_page.add_resource(formx_text, pikepdf.Name.XObject)
                stamp_text = pdf.make_stream(b'q 1 0 0 1 0 0 cm %s Do Q' % formx_name)

                pdf.pages[i].contents_add(stamp_text)
            pdf.save("/pdfs/text" + str(seq) + ".pdf")
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
                URI=seq
            )
        )
        pdf.pages[0].add_annotation(link_annotation)
        pdf.save("/pdfs/uri" + str(seq) + ".pdf")
        count += 1

    return HttpResponse("INJECTION")