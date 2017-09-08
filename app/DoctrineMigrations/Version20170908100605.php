<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170908100605 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D98C03F15C');
        $this->addSql('DROP INDEX IDX_876E0D98C03F15C ON photos');
        $this->addSql('ALTER TABLE photos CHANGE employee_id status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D96BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_876E0D96BF700BD ON photos (status_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D96BF700BD');
        $this->addSql('DROP INDEX IDX_876E0D96BF700BD ON photos');
        $this->addSql('ALTER TABLE photos CHANGE status_id employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D98C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_876E0D98C03F15C ON photos (employee_id)');
    }
}
