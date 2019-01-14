<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218092128 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE addresses (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', apartment_type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', floor VARCHAR(5) NOT NULL, apartment VARCHAR(15) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, INDEX IDX_6FCA75167E3C61F9 (owner_id), INDEX IDX_6FCA7516497A6219 (apartment_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1EF7DAFD5E237E06 (name), UNIQUE INDEX UNIQ_1EF7DAFD3EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA75167E3C61F9 FOREIGN KEY (owner_id) REFERENCES buildings (id)');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516497A6219 FOREIGN KEY (apartment_type_id) REFERENCES apartment_types (id)');
        $this->addSql('ALTER TABLE buildings ADD zip VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE settlements ADD zip VARCHAR(15) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA7516497A6219');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE apartment_types');
        $this->addSql('ALTER TABLE buildings DROP zip');
        $this->addSql('ALTER TABLE settlements DROP zip');
    }
}
