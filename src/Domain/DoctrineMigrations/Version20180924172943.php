<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180924172943 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE p7_client (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE p7_user ADD client_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE p7_user ADD CONSTRAINT FK_7EEF690F19EB6921 FOREIGN KEY (client_id) REFERENCES p7_client (id)');
        $this->addSql('CREATE INDEX IDX_7EEF690F19EB6921 ON p7_user (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE p7_user DROP FOREIGN KEY FK_7EEF690F19EB6921');
        $this->addSql('DROP TABLE p7_client');
        $this->addSql('DROP INDEX IDX_7EEF690F19EB6921 ON p7_user');
        $this->addSql('ALTER TABLE p7_user DROP client_id');
    }
}
