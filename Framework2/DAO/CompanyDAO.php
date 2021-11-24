<?php

namespace DAO;
use \Exception as Exception;
use DAO\IViews as IViews;
use Models\Company as Company;
use DAO\Connection as Connection;
class CompanyDAO implements IViews
{
    private $companytList = array();
  
    private $connection;
    private $tableName = "company";

/*
    public function Add($company)
    {
        $this->RetrieveData();
        array_push($this->companytList, $company);
        $this->SaveData();
    }
*/
public function Add($company)
{    
    try
    {
        $query = "INSERT INTO ".$this->tableName." (CompanyName, BusinessName, CompanyAdress,cuil,telephone,email,web,password ) VALUES (:CompanyName, :BusinessName, :CompanyAdress,:cuil,:telephone,:email,:web,:password);";
    
        $valuesArray["CompanyName"] = $company->getCompanyName();
        $valuesArray["BusinessName"] = $company->getBusinessName();
        $valuesArray["CompanyAdress"] = $company->getCompanyAdress();
        $valuesArray["cuil"]=$company->getCuil();
        $valuesArray["telephone"] = $company->getTelephone();
        $valuesArray["email"] = $company->getEmail();
        $valuesArray["web"] = $company->getWeb();
        $valuesArray["password"]= $company->getPassword();
     
    $this->connection = Connection::GetInstance();
   $this->connection->ExecuteNonQuery($query, $valuesArray);
    }
    catch(Exception $ex)
    {
        throw $ex;
    }
}
   /* public function GetAll()
    {
        $this->RetrieveData();

        return $this->companytList;
    }

*/      
  public function GetAll()
{
    try
    {
        $companytList = array();

        $query = "SELECT * FROM ".$this->tableName;

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);
        
        foreach ($resultSet as $valuesArray)
        {                
            $company = new Company();
            $company->setId_company($valuesArray["id_company"]);
            $company->setCompanyName($valuesArray["CompanyName"]);
            $company->setBusinessName($valuesArray["BusinessName"]);
            $company->setCompanyAdress($valuesArray["CompanyAdress"]);
            $company->setCuil($valuesArray["cuil"]);
            $company->setTelephone($valuesArray["telephone"]);
            $company->setEmail($valuesArray["email"]);
            $company->setWeb($valuesArray["web"]);
            $company->setPassword($valuesArray['password']);

            array_push($companytList, $company);
        }

        return $companytList;
    }
    catch(Exception $ex)
    {
        throw $ex;
    }
}


/*

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->companytList as $company) {
            $valuesArray["user"] = $company->getCompanyAdress ;
            $valuesArray["password"] = $company->getPassword();
            $valuesArray["name"] = $company->getCompanyName() ;
            $valuesArray["BusinessName"] = $company->getBusinessName();
            $valuesArray["description"] = $company->getDescription();
            $valuesArray["telephone"] = $company->getTelephone();
            $valuesArray["email"] = $company->getEmail();
            $valuesArray["web"] = $company->getWeb();


            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData()
    {
        $this->companytList = array();

        if (file_exists($this->fileName)) {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($arrayToDecode as $valuesArray) {
                $company = new Company();
                $company->setUser($valuesArray["user"]);
                $company->setPassword($valuesArray["password"]);
                $company->setName($valuesArray["name"]);
                $company->setBusinessName($valuesArray["BusinessName"]);
                $company->setDescription($valuesArray["description"]);
                $company->setTelephone($valuesArray["telephone"]);
                $company->setEmail($valuesArray["email"]);
                $company->setWeb($valuesArray["web"]);


                array_push($this->companytList, $company);
            }
        }
    }*//*
    public function Modify2($value, $data, $companytList)
    {

        $companytList[$value] = $data;
        $arrayToEncode = array();

        foreach ($companytList as $company) {
            $valuesArray["user"] = $company->getCompanyAdress ;
            $valuesArray["password"] = $company->getPassword();
            $valuesArray["name"] = $company->getCompanyName() ;
            $valuesArray["BusinessName"] = $company->getBusinessName();
            $valuesArray["description"] = $company->getDescription();
            $valuesArray["telephone"] = $company->getTelephone();
            $valuesArray["email"] = $company->getEmail();
            $valuesArray["web"] = $company->getWeb();


            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $jsonContent);
    }*/
    public function Modify( $CompanyName, $BusinessName, $CompanyAdress,$id_company, $telephone, $email, $web,$cuil,$password)
    {   
       
        $this->connection = Connection::GetInstance();
        
        $consulta= "UPDATE company
        SET CompanyName = '$CompanyName', BusinessName = '$BusinessName', CompanyAdress = '$CompanyAdress',cuil = '$cuil', telephone = $telephone, email = '$email', web = '$web', password ='$password'
        WHERE id_company = '$id_company'";
        $connection = $this->connection;
        $connection->Execute($consulta);
    
       /*$result = $selectStatement->fetchAll();
       var_dump($result);*/

       /*
        $sql= $this->connection->$this->Prepare($consulta);
        $sql->bindParam(':CompanyName',$CompanyName);
        $sql->bindParam(':BusinessName',$BusinessName);
        $sql->bindParam(':CompanyAdress',$CompanyAdress);
        $sql->bindParam(':cuil',$cuil);
        $sql->bindParam(':telephone',$telephone);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':web',$web);
        */
        /*$sql->Execute();*/
         
        /*
    $parameters["CompanyName"] = $CompanyName;
    $parameters["BusinessName"] = $BusinessName;
    $parameters["CompanyAdress"] = $CompanyAdress;
    $parameters["cuil"] = $cuil;
    $parameters["telephone"] = $telephone;
    $parameters["email"] = $email;
    $parameters["web"] = $web;

        $this->connection->Execute($consulta,$parameters);
      /*  if($sql->rowCount() > 0)
        {
        $count = $sql -> rowCount();
        echo "<div class='content alert alert-primary' >
        Gracias: $count registro ha sido actualizado </div>";
        }
        else{
        echo "<div class='content alert alert-danger'> No se pudo actulizar el registro </div>";
        print_r($sql->errorInfo()); 
        }*/
    }

    public function delete($CompanyName)
    {
      
        //$this->connection = Connection::GetInstance();
    
        $consulta= "DELETE From company WHERE CompanyName = '$CompanyName'";
      $connection = $this->connection;
        $connection->Execute($consulta);
    }

  /*
    public function Delete2($value,$companytList){
        
        unset($companytList[$value]);  
        $arrayToEncode = array();

        foreach ($companytList as $company) {
            $valuesArray["user"] = $company->getCompanyAdress ;
            $valuesArray["password"] = $company->getPassword();
            $valuesArray["name"] = $company->getCompanyName() ;
            $valuesArray["BusinessName"] = $company->getBusinessName();
            $valuesArray["description"] = $company->getDescription();
            $valuesArray["telephone"] = $company->getTelephone();
            $valuesArray["email"] = $company->getEmail();
            $valuesArray["web"] = $company->getWeb();


            array_push($arrayToEncode, $valuesArray);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $jsonContent);

        }*/

    


}
?>