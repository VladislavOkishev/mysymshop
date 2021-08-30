<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210830132807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB171EB6C');
        $this->addSql('DROP INDEX IDX_E52FFDEEB171EB6C ON orders');
        $this->addSql('ALTER TABLE orders CHANGE customer_id customer_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB171EB6C FOREIGN KEY (customer_id_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEB171EB6C ON orders (customer_id_id)');
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CDE18E50B');
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CFCDAEAAA');
        $this->addSql('DROP INDEX IDX_749C879CFCDAEAAA ON orders_products');
        $this->addSql('DROP INDEX IDX_749C879CDE18E50B ON orders_products');
        $this->addSql('ALTER TABLE orders_products ADD product_id_id INT NOT NULL, ADD order_id_id INT NOT NULL, DROP product_id, DROP order_id');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CDE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_749C879CFCDAEAAA ON orders_products (order_id_id)');
        $this->addSql('CREATE INDEX IDX_749C879CDE18E50B ON orders_products (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB171EB6C');
        $this->addSql('DROP INDEX IDX_E52FFDEEB171EB6C ON orders');
        $this->addSql('ALTER TABLE orders CHANGE customer_id_id customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB171EB6C FOREIGN KEY (customer_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEB171EB6C ON orders (customer_id)');
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CDE18E50B');
        $this->addSql('ALTER TABLE orders_products DROP FOREIGN KEY FK_749C879CFCDAEAAA');
        $this->addSql('DROP INDEX IDX_749C879CDE18E50B ON orders_products');
        $this->addSql('DROP INDEX IDX_749C879CFCDAEAAA ON orders_products');
        $this->addSql('ALTER TABLE orders_products ADD product_id INT NOT NULL, ADD order_id INT NOT NULL, DROP product_id_id, DROP order_id_id');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CDE18E50B FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders_products ADD CONSTRAINT FK_749C879CFCDAEAAA FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_749C879CDE18E50B ON orders_products (product_id)');
        $this->addSql('CREATE INDEX IDX_749C879CFCDAEAAA ON orders_products (order_id)');
    }
}
