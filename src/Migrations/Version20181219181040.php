<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219181040 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE floor_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8B11F0065E237E06 (name), UNIQUE INDEX UNIQ_8B11F0063EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD floor_type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA75166589065F FOREIGN KEY (floor_type_id) REFERENCES floor_types (id)');
        $this->addSql('CREATE INDEX IDX_6FCA75166589065F ON addresses (floor_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA75166589065F');
        $this->addSql('DROP TABLE floor_types');
        $this->addSql('DROP INDEX IDX_6FCA75166589065F ON addresses');
        $this->addSql('ALTER TABLE addresses DROP floor_type_id');
    }
}
