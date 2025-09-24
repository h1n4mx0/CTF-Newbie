FROM python:3.12-slim

ENV PYTHONDONTWRITEBYTECODE=1 \
    PYTHONUNBUFFERED=1 \
    PORT=8000 \
    FLAG=MSEC{Sh3ll_1nj3ct10n_W1th_5ubpr0c3876536373000455} 

WORKDIR /app

RUN useradd -m user && \
    mkdir -p /app/uploads && chown -R user:user /app

COPY --chown=user:user app.py /app/app.py
COPY --chown=user:user templates /app/templates

RUN pip install --no-cache-dir flask==3.0.3

USER user

EXPOSE 8000

CMD ["python", "app.py"]


