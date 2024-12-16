<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\Environment;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216095951 extends AbstractMigration
{
    const UUID = 'd9137b88-0d37-4eb3-ac65-15cc3d5311c2';
    
    protected static array $product = [
        'uuid' => self::UUID,
        'name' => 'Dummy product for test',
        'term' => 12,
        'amount' => 9000,
        'rate' => 3.4
    ];

    public function getDescription(): string
    {
        return 'add dummy product';
    }

    public function up(Schema $schema): void
    {
        if (getenv('APP_ENV') != Environment::PROD->value) {
            $this->addSql('INSERT INTO product VALUES (:uuid, :name, :term, :amount, :rate)', self::$product);
        }
    }

    public function down(Schema $schema): void
    {
        if (getenv('APP_ENV') != Environment::PROD->value) {
            $this->addSql('DELETE FROM product where uuid=:uuid', self::$product);
        }
    }
}
