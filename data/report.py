import os
import subprocess

def check_php_syntax_errors(project_path, log_file_path):
    
    with open(log_file_path, 'w') as log_file:
        
        for root, dirs, files in os.walk(project_path):
            for file in files:
                if file.endswith(".php"):
                    file_path = os.path.join(root, file)
                    
                    result = subprocess.run(['php', '-l', file_path], capture_output=True, text=True)
                    
                    if result.returncode != 0:
                        log_file.write(f"Syntax error in file: {file_path}\n")
                        log_file.write(result.stderr + "\n")
                        print(f"Error found in {file_path}")
    
    print(f"Syntax errors have been logged in {log_file_path}")


project_path = '../'
log_file_path = 'php_errors.log'

check_php_syntax_errors(project_path, log_file_path)

