<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117223833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1FC0F36A54963938 ON doctor (api_id)');
        $this->addSql('CREATE UNIQUE INDEX doctor_slot_start_time_idx ON slot (doctor_id, start_time)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1FC0F36A54963938 ON doctor');
        $this->addSql('DROP INDEX doctor_slot_start_time_idx ON slot');
    }
}
