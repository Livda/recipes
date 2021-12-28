FROM mariadb:10

ARG UID=1000
ARG GID=1000

RUN addgroup --system --gid $GID symfony ;\
    adduser --system --uid $UID --gid $GID --no-create-home symfony