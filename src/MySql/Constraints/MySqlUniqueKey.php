<?php

namespace Squille\Cave\MySql\Constraints;

use PDO;
use Squille\Cave\Models\IConstraintModel;
use Squille\Cave\UnconformitiesList;

class MySqlUniqueKey extends AbstractMySqlConstraint
{
    private $pdo;
    private $name;
    private $type;

    public function __construct(PDO $pdo, array $partialConstraints)
    {
        $this->pdo = $pdo;

        $this->name = $partialConstraints[0]->getName();
        $this->type = $partialConstraints[0]->getType();

        parent::__construct($partialConstraints);
    }

    public function checkIntegrity(IConstraintModel $constraintModel)
    {
        return new UnconformitiesList();
    }

    public function __toString()
    {
        return sprintf("UNIQUE KEY %s USING %s (%s)", $this->name, $this->type, parent::__toString());
    }

    public function getName()
    {
        return $this->name;
    }

    public function dropCommand()
    {
        return "DROP KEY {$this->getName()}";
    }
}
