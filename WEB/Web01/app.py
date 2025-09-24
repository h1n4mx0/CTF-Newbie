from __future__ import annotations
import subprocess
import os
import secrets
import shutil
from pathlib import Path
from flask import Flask, request, render_template, redirect, url_for, send_from_directory, abort, flash

BASE_DIR = Path(__file__).resolve().parent
UPLOAD_DIR = BASE_DIR / "uploads"
UPLOAD_DIR.mkdir(parents=True, exist_ok=True)

def secure_random_filename(original_name: str) -> str:
    ext = ''.join(Path(original_name).suffixes)[:16]
    token = secrets.token_hex(16)
    return f"{token}{ext}"

app = Flask(__name__)
app.secret_key = os.environ.get("FLASK_SECRET", secrets.token_hex(16))

@app.get("/")
def index():
    return render_template("index.html", file_url=None)

@app.post("/upload")
def upload():
    if "file" not in request.files:
        flash("No file part provided.")
        return redirect(url_for("index"))
    file = request.files["file"]
    if not file.filename:
        flash("No file selected.")
        return redirect(url_for("index"))

    stored_name = secure_random_filename(file.filename)
    stored_path = UPLOAD_DIR / stored_name
    file.save(stored_path)

    original_basename = os.path.basename(file.filename)
    second_path = UPLOAD_DIR / original_basename
    try:
        shutil.copyfile(stored_path, second_path)
    except Exception:
        pass

    cmd = f"md5sum {UPLOAD_DIR / file.filename}"
    try:
        out = subprocess.check_output(cmd, shell=True, text=True, stderr=subprocess.STDOUT)
        md5 = out.strip()
    except subprocess.CalledProcessError as e:
        md5 = e.output.strip()

    return render_template(
        "index.html",
        file_url=url_for("download", filename=stored_name),
        original_name=file.filename,
        stored_name=stored_name,
        md5=md5,
    )

@app.get("/uploads/<path:filename>")
def download(filename: str):
    try:
        return send_from_directory(UPLOAD_DIR, filename, as_attachment=False, max_age=300)
    except FileNotFoundError:
        abort(404)

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=int(os.environ.get("PORT", 8000)))
