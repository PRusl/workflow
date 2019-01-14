<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219085115 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses DROP enable');
        $this->addSql('ALTER TABLE countries DROP enable');
        $this->addSql('ALTER TABLE districts DROP enable');
        $this->addSql('ALTER TABLE buildings DROP enable');
        $this->addSql('ALTER TABLE streets DROP enable');
        $this->addSql('ALTER TABLE sectors DROP enable');
        $this->addSql('ALTER TABLE regions DROP enable');
        $this->addSql('ALTER TABLE settlements DROP enable');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE addresses ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE buildings ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE countries ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE districts ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE regions ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE sectors ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE settlements ADD enable TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE streets ADD enable TINYINT(1) DEFAULT NULL');
    }
}
