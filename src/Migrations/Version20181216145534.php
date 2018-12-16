<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216145534 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE countries (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_5D66EBAD5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A26779F35E237E06 (name), INDEX IDX_A26779F37E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE regions ADD CONSTRAINT FK_A26779F37E3C61F9 FOREIGN KEY (owner_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regions DROP FOREIGN KEY FK_A26779F37E3C61F9');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE regions');
    }
}
