<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122133540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recept ADD dose INT NOT NULL, CHANGE doce patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE recept ADD CONSTRAINT FK_B92268A16B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_B92268A16B899279 ON recept (patient_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recept DROP FOREIGN KEY FK_B92268A16B899279');
        $this->addSql('DROP INDEX IDX_B92268A16B899279 ON recept');
        $this->addSql('ALTER TABLE recept ADD doce INT NOT NULL, DROP patient_id, DROP dose');
    }
}
