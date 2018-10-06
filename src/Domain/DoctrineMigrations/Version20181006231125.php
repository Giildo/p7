<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181006231125 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE p7_brand (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE p7_phone ADD brand_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP brand');
        $this->addSql('ALTER TABLE p7_phone ADD CONSTRAINT FK_DB030FC744F5D008 FOREIGN KEY (brand_id) REFERENCES p7_brand (id)');
        $this->addSql('CREATE INDEX IDX_DB030FC744F5D008 ON p7_phone (brand_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE p7_phone DROP FOREIGN KEY FK_DB030FC744F5D008');
        $this->addSql('DROP TABLE p7_brand');
        $this->addSql('DROP INDEX IDX_DB030FC744F5D008 ON p7_phone');
        $this->addSql('ALTER TABLE p7_phone ADD brand VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, DROP brand_id');
    }
}
