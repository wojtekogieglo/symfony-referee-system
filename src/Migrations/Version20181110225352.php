<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181110225352 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clubs (id INT AUTO_INCREMENT NOT NULL, club_name VARCHAR(255) NOT NULL, league VARCHAR(255) NOT NULL, stadium VARCHAR(255) NOT NULL, founded_year VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, club_id_home_id INT NOT NULL, club_id_away_id INT NOT NULL, referee_id_id INT NOT NULL, season VARCHAR(255) NOT NULL, match_day VARCHAR(255) NOT NULL, date DATE NOT NULL, round VARCHAR(255) NOT NULL, score VARCHAR(255) DEFAULT NULL, yellow_cards VARCHAR(255) DEFAULT NULL, red_cards INT DEFAULT NULL, penalties INT DEFAULT NULL, INDEX IDX_FF232B31BF962F01 (club_id_home_id), INDEX IDX_FF232B311AB4EF02 (club_id_away_id), INDEX IDX_FF232B3131ECF2BC (referee_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referee (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, wydzial_sedziowski VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, INDEX IDX_D60FB3429D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31BF962F01 FOREIGN KEY (club_id_home_id) REFERENCES clubs (id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B311AB4EF02 FOREIGN KEY (club_id_away_id) REFERENCES clubs (id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B3131ECF2BC FOREIGN KEY (referee_id_id) REFERENCES referee (id)');
        $this->addSql('ALTER TABLE referee ADD CONSTRAINT FK_D60FB3429D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B31BF962F01');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B311AB4EF02');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B3131ECF2BC');
        $this->addSql('ALTER TABLE referee DROP FOREIGN KEY FK_D60FB3429D86650F');
        $this->addSql('DROP TABLE clubs');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE referee');
        $this->addSql('DROP TABLE user');
    }
}
