import zipfile
import os

def zip_folder(folder_path, output_path):
    print(f"Zipping {folder_path} to {output_path}...")
    with zipfile.ZipFile(output_path, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(folder_path):
            for file in files:
                file_path = os.path.join(root, file)
                # Calculate relative path
                arcname = os.path.relpath(file_path, folder_path)
                # Force forward slashes for Linux compatibility
                arcname = arcname.replace(os.path.sep, '/')
                zipf.write(file_path, arcname)
    print("Done!")

if __name__ == "__main__":
    zip_folder('release', 'LenzBreeze_Install_Fixed.zip')
