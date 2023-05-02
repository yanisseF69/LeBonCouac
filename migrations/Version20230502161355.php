<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502161355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188805AB2F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E56F858F92');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX IDX_14B784188805AB2F ON photo');
        $this->addSql('ALTER TABLE photo ADD id_a_id INT NOT NULL, DROP annonce_id');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418B0FE4F5A FOREIGN KEY (id_a_id) REFERENCES announcement (id)');
        $this->addSql('CREATE INDEX IDX_14B78418B0FE4F5A ON photo (id_a_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, id_u_id INT NOT NULL, titre VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, ville VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, region VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F65593E56F858F92 (id_u_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mail VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E56F858F92 FOREIGN KEY (id_u_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418B0FE4F5A');
        $this->addSql('DROP INDEX IDX_14B78418B0FE4F5A ON photo');
        $this->addSql('ALTER TABLE photo ADD annonce_id INT DEFAULT NULL, DROP id_a_id');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_14B784188805AB2F ON photo (annonce_id)');
    }
}
