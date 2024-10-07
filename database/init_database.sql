CREATE TABLE users
(
    id           SERIAL PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    email        VARCHAR(150) NOT NULL UNIQUE,
    phone_number VARCHAR(20) UNIQUE,
    password     VARCHAR(255) NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE appointments
(
    id                       SERIAL PRIMARY KEY,
    user_id                  INT          NOT NULL REFERENCES users (id) ON DELETE CASCADE,
    title                    VARCHAR(150) NOT NULL,
    description              TEXT,
    appointment_date         TIMESTAMP    NOT NULL,
    reminder_email           BOOLEAN   DEFAULT FALSE,
    reminder_whatsapp        BOOLEAN   DEFAULT FALSE,
    google_calendar_event_id VARCHAR(255),
    created_at               TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notifications
(
    id                  SERIAL PRIMARY KEY,
    appointment_id      INT         NOT NULL REFERENCES appointments (id) ON DELETE CASCADE,
    notification_type   VARCHAR(50) NOT NULL,          -- email ou whatsapp
    notification_status VARCHAR(50) DEFAULT 'pending', -- pending, sent, failed
    notification_date   TIMESTAMP   NOT NULL,
    created_at          TIMESTAMP   DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE integration_tokens
(
    id               SERIAL PRIMARY KEY,
    user_id          INT         NOT NULL REFERENCES users (id) ON DELETE CASCADE,
    provider         VARCHAR(50) NOT NULL, -- Ex: google_calendar
    access_token     TEXT        NOT NULL,
    refresh_token    TEXT,
    token_expires_at TIMESTAMP   NOT NULL,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_users_email ON users (email);
CREATE INDEX idx_appointments_user_id ON appointments (user_id);
CREATE INDEX idx_notifications_appointment_id ON notifications (appointment_id);
CREATE INDEX idx_integration_tokens_user_id ON integration_tokens (user_id);