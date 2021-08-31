<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831095337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D6EE88A');
        $this->addSql('DROP INDEX IDX_2530ADE68D6EE88A ON order_product');
        $this->addSql('ALTER TABLE order_product CHANGE oorder_id order1_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE6FEE30A60 FOREIGN KEY (order1_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE6FEE30A60 ON order_product (order1_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE6FEE30A60');
        $this->addSql('DROP INDEX IDX_2530ADE6FEE30A60 ON order_product');
        $this->addSql('ALTER TABLE order_product CHANGE order1_id oorder_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D6EE88A FOREIGN KEY (oorder_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE68D6EE88A ON order_product (oorder_id)');
    }
}
