CREATE TABLE file
(
    id          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name        TEXT,
    "type"      TEXT    NOT NULL,
    "path"      TEXT    NOT NULL,
    error       TEXT    NOT NULL,
    "size"      INTEGER NOT NULL,
    uploaded_at TEXT    NOT NULL
);

CREATE TABLE cv
(
    id         INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name       TEXT    NOT NULL,
    email      TEXT    NOT NULL,
    telephone  TEXT    NOT NULL,
    "position" TEXT    NOT NULL,
    education  TEXT    NOT NULL,
    comments   TEXT,
    file_id    INTEGER NOT NULL,
    created_at TEXT    NOT NULL,
    ip_address TEXT    NOT NULL,
    CONSTRAINT cv_FK FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE
);