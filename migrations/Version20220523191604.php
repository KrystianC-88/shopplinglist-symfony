<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523191604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_rooms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, room_id_id INT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19C135F83FFC ON category (room_id_id)');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, room_id_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(30) NOT NULL, is_bought BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F1B251E35F83FFC ON item (room_id_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E12469DE2 ON item (category_id)');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, owner_id INT NOT NULL, name VARCHAR(30) NOT NULL, uuid VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
        $this->addSql('CREATE TABLE users_rooms (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users_rooms_user (users_rooms_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(users_rooms_id, user_id))');
        $this->addSql('CREATE INDEX IDX_3D0F6D20F5624371 ON users_rooms_user (users_rooms_id)');
        $this->addSql('CREATE INDEX IDX_3D0F6D20A76ED395 ON users_rooms_user (user_id)');
        $this->addSql('CREATE TABLE users_rooms_room (users_rooms_id INT NOT NULL, room_id INT NOT NULL, PRIMARY KEY(users_rooms_id, room_id))');
        $this->addSql('CREATE INDEX IDX_C203EAF2F5624371 ON users_rooms_room (users_rooms_id)');
        $this->addSql('CREATE INDEX IDX_C203EAF254177093 ON users_rooms_room (room_id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C135F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E35F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_rooms_user ADD CONSTRAINT FK_3D0F6D20F5624371 FOREIGN KEY (users_rooms_id) REFERENCES users_rooms (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_rooms_user ADD CONSTRAINT FK_3D0F6D20A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_rooms_room ADD CONSTRAINT FK_C203EAF2F5624371 FOREIGN KEY (users_rooms_id) REFERENCES users_rooms (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_rooms_room ADD CONSTRAINT FK_C203EAF254177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251E12469DE2');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C135F83FFC');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251E35F83FFC');
        $this->addSql('ALTER TABLE users_rooms_room DROP CONSTRAINT FK_C203EAF254177093');
        $this->addSql('ALTER TABLE users_rooms_user DROP CONSTRAINT FK_3D0F6D20F5624371');
        $this->addSql('ALTER TABLE users_rooms_room DROP CONSTRAINT FK_C203EAF2F5624371');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_rooms_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE users_rooms');
        $this->addSql('DROP TABLE users_rooms_user');
        $this->addSql('DROP TABLE users_rooms_room');
    }
}
