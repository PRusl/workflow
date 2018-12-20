<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219095408 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_5D66EBAD5E237E06 ON countries');
        $this->addSql('DROP INDEX UNIQ_68E318DC5E237E06 ON districts');
        $this->addSql('DROP INDEX UNIQ_9A51B6A75E237E06 ON buildings');
        $this->addSql('DROP INDEX UNIQ_93F67B3E5E237E06 ON streets');
        $this->addSql('DROP INDEX UNIQ_B59406985E237E06 ON sectors');
        $this->addSql('DROP INDEX UNIQ_A26779F35E237E06 ON regions');
        $this->addSql('DROP INDEX UNIQ_7BF31725E237E06 ON settlements');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_9A51B6A75E237E06 ON buildings (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D66EBAD5E237E06 ON countries (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_68E318DC5E237E06 ON districts (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A26779F35E237E06 ON regions (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B59406985E237E06 ON sectors (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7BF31725E237E06 ON settlements (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93F67B3E5E237E06 ON streets (name)');
    }
}
