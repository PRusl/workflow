<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217104913 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE countries (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_5D66EBAD5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settlement_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_63984FFC5E237E06 (name), UNIQUE INDEX UNIQ_63984FFC3EE4B093 (short_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE districts (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_68E318DC5E237E06 (name), INDEX IDX_68E318DC7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE buildings (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_9A51B6A75E237E06 (name), INDEX IDX_9A51B6A77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE streets (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_93F67B3E5E237E06 (name), INDEX IDX_93F67B3E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sectors (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_B59406985E237E06 (name), INDEX IDX_B59406987E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE regions (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A26779F35E237E06 (name), INDEX IDX_A26779F37E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settlements (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', owner_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, enable TINYINT(1) NOT NULL, use_default TINYINT(1) NOT NULL, top TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7BF31725E237E06 (name), INDEX IDX_7BF31727E3C61F9 (owner_id), INDEX IDX_7BF3172C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE districts ADD CONSTRAINT FK_68E318DC7E3C61F9 FOREIGN KEY (owner_id) REFERENCES regions (id)');
        $this->addSql('ALTER TABLE buildings ADD CONSTRAINT FK_9A51B6A77E3C61F9 FOREIGN KEY (owner_id) REFERENCES streets (id)');
        $this->addSql('ALTER TABLE streets ADD CONSTRAINT FK_93F67B3E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES sectors (id)');
        $this->addSql('ALTER TABLE sectors ADD CONSTRAINT FK_B59406987E3C61F9 FOREIGN KEY (owner_id) REFERENCES settlements (id)');
        $this->addSql('ALTER TABLE regions ADD CONSTRAINT FK_A26779F37E3C61F9 FOREIGN KEY (owner_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE settlements ADD CONSTRAINT FK_7BF31727E3C61F9 FOREIGN KEY (owner_id) REFERENCES districts (id)');
        $this->addSql('ALTER TABLE settlements ADD CONSTRAINT FK_7BF3172C54C8C93 FOREIGN KEY (type_id) REFERENCES settlement_types (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regions DROP FOREIGN KEY FK_A26779F37E3C61F9');
        $this->addSql('ALTER TABLE settlements DROP FOREIGN KEY FK_7BF3172C54C8C93');
        $this->addSql('ALTER TABLE settlements DROP FOREIGN KEY FK_7BF31727E3C61F9');
        $this->addSql('ALTER TABLE buildings DROP FOREIGN KEY FK_9A51B6A77E3C61F9');
        $this->addSql('ALTER TABLE streets DROP FOREIGN KEY FK_93F67B3E7E3C61F9');
        $this->addSql('ALTER TABLE districts DROP FOREIGN KEY FK_68E318DC7E3C61F9');
        $this->addSql('ALTER TABLE sectors DROP FOREIGN KEY FK_B59406987E3C61F9');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE settlement_types');
        $this->addSql('DROP TABLE districts');
        $this->addSql('DROP TABLE buildings');
        $this->addSql('DROP TABLE streets');
        $this->addSql('DROP TABLE sectors');
        $this->addSql('DROP TABLE regions');
        $this->addSql('DROP TABLE settlements');
    }
}
