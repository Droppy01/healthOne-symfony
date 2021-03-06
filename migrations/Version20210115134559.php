<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115134559 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D99395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_1FBFB8D99395C3F3 ON prescription (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D99395C3F3');
        $this->addSql('DROP INDEX IDX_1FBFB8D99395C3F3 ON prescription');
        $this->addSql('ALTER TABLE prescription DROP customer_id');
    }
}
