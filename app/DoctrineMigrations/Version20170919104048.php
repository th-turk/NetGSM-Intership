<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170919104048 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP INDEX IDX_876E0D96BF700BD, ADD UNIQUE INDEX UNIQ_876E0D96BF700BD (status_id)');
        $this->addSql('ALTER TABLE users CHANGE usernamee username VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP INDEX UNIQ_876E0D96BF700BD, ADD INDEX IDX_876E0D96BF700BD (status_id)');
        $this->addSql('ALTER TABLE users CHANGE username usernamee VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
