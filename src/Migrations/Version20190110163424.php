<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110163424 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', short_name VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, INDEX IDX_34DCD176C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE firm_address_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE firm (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', code INT NOT NULL, ipn INT DEFAULT NULL, short_name VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_560581FD77153098 (code), UNIQUE INDEX UNIQ_560581FD3D721C14 (ipn), INDEX IDX_560581FDC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_types (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE firm_address (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', firm_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', address_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_D497C5F989AF7860 (firm_id), INDEX IDX_D497C5F9F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE firm_person (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', firm_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', person_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_3B2C759F89AF7860 (firm_id), INDEX IDX_3B2C759F217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176C54C8C93 FOREIGN KEY (type_id) REFERENCES person_types (id)');
        $this->addSql('ALTER TABLE firm ADD CONSTRAINT FK_560581FDC54C8C93 FOREIGN KEY (type_id) REFERENCES firm_address_types (id)');
        $this->addSql('ALTER TABLE firm_address ADD CONSTRAINT FK_D497C5F989AF7860 FOREIGN KEY (firm_id) REFERENCES firm (id)');
        $this->addSql('ALTER TABLE firm_address ADD CONSTRAINT FK_D497C5F9F5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id)');
        $this->addSql('ALTER TABLE firm_person ADD CONSTRAINT FK_3B2C759F89AF7860 FOREIGN KEY (firm_id) REFERENCES firm (id)');
        $this->addSql('ALTER TABLE firm_person ADD CONSTRAINT FK_3B2C759F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm_person DROP FOREIGN KEY FK_3B2C759F217BBB47');
        $this->addSql('ALTER TABLE firm DROP FOREIGN KEY FK_560581FDC54C8C93');
        $this->addSql('ALTER TABLE firm_address DROP FOREIGN KEY FK_D497C5F989AF7860');
        $this->addSql('ALTER TABLE firm_person DROP FOREIGN KEY FK_3B2C759F89AF7860');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176C54C8C93');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE firm_address_types');
        $this->addSql('DROP TABLE firm');
        $this->addSql('DROP TABLE person_types');
        $this->addSql('DROP TABLE firm_address');
        $this->addSql('DROP TABLE firm_person');
    }
}
