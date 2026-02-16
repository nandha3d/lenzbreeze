import os
import zipfile

def create_zip(source_dir, output_filename):
    # Essential production exclusions
    exclude_dirs = {
        '.git', '.vscode', 'node_modules', 'tests', 
        '__pycache__', '.pytest_cache', '.qodo', 'release'
    }
    exclude_files = {
        '.env', '.gitignore', '.gitattributes', 'phpunit.xml',
        'create_deploy_package.ps1', 'create_deploy_package.py',
        'create_deploy_zip.py', 'create_storage_fix.py', 'fix_fix.py',
        'start_servers.ps1', 'fix_403_error.txt', 'hot'
    }
    
    print(f"Creating Zip: {output_filename}")
    
    with zipfile.ZipFile(output_filename, 'w', zipfile.ZIP_DEFLATED) as zipf:
        for root, dirs, files in os.walk(source_dir):
            # Prune excluded directories
            dirs[:] = [d for d in dirs if d not in exclude_dirs]
            
            for file in files:
                # Exclude specific files and ANY existing zip files
                if file in exclude_files or file.endswith('.zip') or file.endswith('.rar'):
                    continue
                
                file_path = os.path.join(root, file)
                arcname = os.path.relpath(file_path, source_dir)
                
                try:
                    zipf.write(file_path, arcname)
                except Exception as e:
                    print(f"Skipping {file_path} due to error: {e}")

    print("Zip created successfully.")

if __name__ == "__main__":
    source = r"d:\PROJECTS\WEBSITES\lenzbreeze"
    output = "LenzBreeze_Production.zip"
    create_zip(source, output)
