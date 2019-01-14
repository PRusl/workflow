<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218201013 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE countries DROP use_default, DROP top');
        $this->addSql('ALTER TABLE districts DROP use_default, DROP top');
        $this->addSql('ALTER TABLE buildings DROP use_default, DROP top');
        $this->addSql('ALTER TABLE streets DROP use_default, DROP top');
        $this->addSql('ALTER TABLE sectors DROP use_default, DROP top');
        $this->addSql('ALTER TABLE regions DROP use_default, DROP top');
        $this->addSql('ALTER TABLE settlements DROP use_default, DROP top');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE buildings ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE countries ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE districts ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regions ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE sectors ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE settlements ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE streets ADD use_default TINYINT(1) DEFAULT NULL, ADD top TINYINT(1) DEFAULT NULL');
    }
}
