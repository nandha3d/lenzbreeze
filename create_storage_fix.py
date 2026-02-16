import zipfile
import os

OUTPUT_FILE = "storage_fix.zip"

def create_storage_zip():
    print(f"Creating {OUTPUT_FILE}...")
    
    with zipfile.ZipFile(OUTPUT_FILE, 'w', zipfile.ZIP_DEFLATED) as zipf:
        # Define necessary directories
        dirs_to_create = [
            "storage/",
            "storage/app/",
            "storage/app/public/",
            "storage/framework/",
            "storage/framework/cache/",
            "storage/framework/cache/data/",
            "storage/framework/sessions/",
            "storage/framework/testing/",
            "storage/framework/views/",
            "storage/logs/",
            "bootstrap/",
            "bootstrap/cache/"
        ]

        for dir_path in dirs_to_create:
            # Create a dummy entry for the directory
            zip_info = zipfile.ZipInfo(dir_path)
            zipf.writestr(zip_info, '')
            
            # Add a .gitignore to make sure it's valid (optional but good practice)
            # zipf.writestr(dir_path + ".gitignore", "*\n!.gitignore")
            print(f"Added {dir_path}")

    print(f"SUCCESS: Created {OUTPUT_FILE}")

if __name__ == "__main__":
    create_storage_zip()
