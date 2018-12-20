<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219175058 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE settlement_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE region_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE building_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE apartment_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE street_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE district_types CHANGE short_name short_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apartment_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE building_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE district_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE region_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE settlement_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE street_types CHANGE short_name short_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
