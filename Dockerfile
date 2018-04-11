FROM php:7.2-cli-alpine

COPY test.php /app/
RUN mkdir /app/data

ENV TEST_LIMIT=0 \
    TEST_DELAY=100 \
    TEST_LOCK=1

CMD ["php", "/app/test.php"]

