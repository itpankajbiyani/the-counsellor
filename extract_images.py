import fitz
import os

pdf_file = "Biyani_Ghar_Website_Layout_v3.pdf"
doc = fitz.open(pdf_file)
os.makedirs("public/images/layout", exist_ok=True)

total = 0
for page_index in range(len(doc)):
    page = doc[page_index]
    image_list = page.get_images(full=True)
    
    for image_index, img in enumerate(image_list, start=1):
        xref = img[0]
        base_image = doc.extract_image(xref)
        image_bytes = base_image["image"]
        image_ext = base_image["ext"]
        image_filename = f"public/images/layout/img_{page_index}_{image_index}.{image_ext}"
        
        with open(image_filename, "wb") as f:
            f.write(image_bytes)
        total += 1

print(f"Extracted {total} images.")
