import zipfile
import os
import shutil

# Configuration
SOURCE_DIR = "."
OUTPUT_FILE = "LenzBreeze_Upload_Me.zip"
EXCLUDE_DIRS = {'.git', '.vscode', 'node_modules', 'tests', 'storage', '.idea', '.qodo'}
EXCLUDE_FILES = {
    'deploy.zip', 
    'LenzBreeze_Upload_Me.zip',
    '.env', 
    'LenzBreeze_Install.zip', 
    'LenzBreeze_Install_Fixed.zip',
    'create_deploy_package.ps1',
    'create_deploy_package.py',
    'fix_zip.py',
    'fix_403_error.txt'
}

def create_zip():
    print(f"Creating {OUTPUT_FILE}...")
    
    try:
        if os.path.exists(OUTPUT_FILE):
            os.remove(OUTPUT_FILE)
            
        with zipfile.ZipFile(OUTPUT_FILE, 'w', zipfile.ZIP_DEFLATED) as zipf:
            for root, dirs, files in os.walk(SOURCE_DIR):
                # Filter exclusions
                dirs[:] = [d for d in dirs if d not in EXCLUDE_DIRS]
                
                for file in files:
                    if file in EXCLUDE_FILES or file.endswith('.zip') or file.endswith('.log'):
                        continue
                        
                    file_path = os.path.join(root, file)
                    arcname = os.path.relpath(file_path, SOURCE_DIR)
                    
                    try:
                        # Try to read
                        with open(file_path, 'rb') as f:
                            pass
                        zipf.write(file_path, arcname)
                    except PermissionError:
                        print(f"Skipping locked file: {arcname}")
                    except Exception as e:
                        print(f"Error adding {arcname}: {e}")
                        
        print(f"SUCCESS: Created {OUTPUT_FILE}")
        
    except Exception as e:
        print(f"FATAL ERROR: {e}")

if __name__ == "__main__":
    create_zip()
