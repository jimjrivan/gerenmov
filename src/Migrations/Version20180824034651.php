<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180824034651 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departamento (id INT AUTO_INCREMENT NOT NULL, nome_str VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario (id INT AUTO_INCREMENT NOT NULL, nome_str VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funcionario_departamento (funcionario_id INT NOT NULL, departamento_id INT NOT NULL, INDEX IDX_91D67834642FEB76 (funcionario_id), INDEX IDX_91D678345A91C08D (departamento_id), PRIMARY KEY(funcionario_id, departamento_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movimentos (id INT AUTO_INCREMENT NOT NULL, funcionario_id INT DEFAULT NULL, descricao_str VARCHAR(500) NOT NULL, valor_num DOUBLE PRECISION NOT NULL, INDEX IDX_7688CB09642FEB76 (funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE funcionario_departamento ADD CONSTRAINT FK_91D67834642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE funcionario_departamento ADD CONSTRAINT FK_91D678345A91C08D FOREIGN KEY (departamento_id) REFERENCES departamento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movimentos ADD CONSTRAINT FK_7688CB09642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionario (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionario_departamento DROP FOREIGN KEY FK_91D678345A91C08D');
        $this->addSql('ALTER TABLE funcionario_departamento DROP FOREIGN KEY FK_91D67834642FEB76');
        $this->addSql('ALTER TABLE movimentos DROP FOREIGN KEY FK_7688CB09642FEB76');
        $this->addSql('DROP TABLE departamento');
        $this->addSql('DROP TABLE funcionario');
        $this->addSql('DROP TABLE funcionario_departamento');
        $this->addSql('DROP TABLE movimentos');
    }
}
