<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219172057 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE region_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E1548A285E237E06 (name), UNIQUE INDEX UNIQ_E1548A283EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE building_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_359038AA5E237E06 (name), UNIQUE INDEX UNIQ_359038AA3EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE street_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6054BBBC5E237E06 (name), UNIQUE INDEX UNIQ_6054BBBC3EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE district_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F6762E035E237E06 (name), UNIQUE INDEX UNIQ_F6762E033EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE districts ADD type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE districts ADD CONSTRAINT FK_68E318DCC54C8C93 FOREIGN KEY (type_id) REFERENCES district_types (id)');
        $this->addSql('CREATE INDEX IDX_68E318DCC54C8C93 ON districts (type_id)');
        $this->addSql('ALTER TABLE buildings ADD type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE buildings ADD CONSTRAINT FK_9A51B6A7C54C8C93 FOREIGN KEY (type_id) REFERENCES building_types (id)');
        $this->addSql('CREATE INDEX IDX_9A51B6A7C54C8C93 ON buildings (type_id)');
        $this->addSql('ALTER TABLE streets ADD type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE streets ADD CONSTRAINT FK_93F67B3EC54C8C93 FOREIGN KEY (type_id) REFERENCES street_types (id)');
        $this->addSql('CREATE INDEX IDX_93F67B3EC54C8C93 ON streets (type_id)');
        $this->addSql('ALTER TABLE regions ADD type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE regions ADD CONSTRAINT FK_A26779F3C54C8C93 FOREIGN KEY (type_id) REFERENCES region_types (id)');
        $this->addSql('CREATE INDEX IDX_A26779F3C54C8C93 ON regions (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regions DROP FOREIGN KEY FK_A26779F3C54C8C93');
        $this->addSql('ALTER TABLE buildings DROP FOREIGN KEY FK_9A51B6A7C54C8C93');
        $this->addSql('ALTER TABLE streets DROP FOREIGN KEY FK_93F67B3EC54C8C93');
        $this->addSql('ALTER TABLE districts DROP FOREIGN KEY FK_68E318DCC54C8C93');
        $this->addSql('DROP TABLE region_types');
        $this->addSql('DROP TABLE building_types');
        $this->addSql('DROP TABLE street_types');
        $this->addSql('DROP TABLE district_types');
        $this->addSql('DROP INDEX IDX_9A51B6A7C54C8C93 ON buildings');
        $this->addSql('ALTER TABLE buildings DROP type_id');
        $this->addSql('DROP INDEX IDX_68E318DCC54C8C93 ON districts');
        $this->addSql('ALTER TABLE districts DROP type_id');
        $this->addSql('DROP INDEX IDX_A26779F3C54C8C93 ON regions');
        $this->addSql('ALTER TABLE regions DROP type_id');
        $this->addSql('DROP INDEX IDX_93F67B3EC54C8C93 ON streets');
        $this->addSql('ALTER TABLE streets DROP type_id');
    }
}
