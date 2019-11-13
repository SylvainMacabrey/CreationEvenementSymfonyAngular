<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102080521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, organisateur_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, date DATETIME NOT NULL, nb_participant INT NOT NULL, privatisation TINYINT(1) NOT NULL, INDEX IDX_B26681ED936B2FA (organisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_participants_evenement (user_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_41816A7BA76ED395 (user_id), INDEX IDX_41816A7BFD02F13 (evenement_id), PRIMARY KEY(user_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_invites_evenement (user_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_340104D3A76ED395 (user_id), INDEX IDX_340104D3FD02F13 (evenement_id), PRIMARY KEY(user_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681ED936B2FA FOREIGN KEY (organisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_participants_evenement ADD CONSTRAINT FK_41816A7BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_participants_evenement ADD CONSTRAINT FK_41816A7BFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_invites_evenement ADD CONSTRAINT FK_340104D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_invites_evenement ADD CONSTRAINT FK_340104D3FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_participants_evenement DROP FOREIGN KEY FK_41816A7BFD02F13');
        $this->addSql('ALTER TABLE user_invites_evenement DROP FOREIGN KEY FK_340104D3FD02F13');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681ED936B2FA');
        $this->addSql('ALTER TABLE user_participants_evenement DROP FOREIGN KEY FK_41816A7BA76ED395');
        $this->addSql('ALTER TABLE user_invites_evenement DROP FOREIGN KEY FK_340104D3A76ED395');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_participants_evenement');
        $this->addSql('DROP TABLE user_invites_evenement');
    }
}
