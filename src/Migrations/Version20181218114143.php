<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218114143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses CHANGE enable enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE countries CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE districts ADD show_in_address TINYINT(1) DEFAULT NULL, CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE buildings CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE streets CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE sectors CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regions CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE settlements CHANGE enable enable TINYINT(1) DEFAULT NULL, CHANGE use_default use_default TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses CHANGE enable enable TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE buildings CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE countries CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE districts DROP show_in_address, CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE regions CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE sectors CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE settlements CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE streets CHANGE enable enable TINYINT(1) NOT NULL, CHANGE use_default use_default TINYINT(1) NOT NULL');
    }
}
