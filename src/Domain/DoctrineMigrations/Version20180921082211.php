<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180921082211 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE p7_phone_memory (phone_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', memory_size SMALLINT NOT NULL, INDEX IDX_5D47842E3B7323CB (phone_id), INDEX IDX_5D47842E58F34F64 (memory_size), PRIMARY KEY(phone_id, memory_size)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE p7_phone_memory ADD CONSTRAINT FK_5D47842E3B7323CB FOREIGN KEY (phone_id) REFERENCES p7_phone (id)');
        $this->addSql('ALTER TABLE p7_phone_memory ADD CONSTRAINT FK_5D47842E58F34F64 FOREIGN KEY (memory_size) REFERENCES p7_memory (size)');
        $this->addSql('DROP TABLE phone_memory');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE phone_memory (phone_id CHAR(36) NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\', memory_size SMALLINT NOT NULL, INDEX IDX_17FC973A3B7323CB (phone_id), INDEX IDX_17FC973A58F34F64 (memory_size), PRIMARY KEY(phone_id, memory_size)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phone_memory ADD CONSTRAINT FK_17FC973A3B7323CB FOREIGN KEY (phone_id) REFERENCES p7_phone (id)');
        $this->addSql('ALTER TABLE phone_memory ADD CONSTRAINT FK_17FC973A58F34F64 FOREIGN KEY (memory_size) REFERENCES p7_memory (size)');
        $this->addSql('DROP TABLE p7_phone_memory');
    }
}
