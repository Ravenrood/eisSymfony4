# eisSymfony4
AD.1.
  A.Brakuje operacji grupowania w celu wykonania operacji agregacji:

SELECT p.id, p.number, SUM(i.premium)
FROM policy p
RIGHT JOIN installment i ON i.policy_id = p.id
GROUP BY p.id
HAVING COUNT(i.id) > 1;
  B.Rozwiązanie dla optymalizacji zapytania:
  SELECT
    p.id AS policy_id, i.id AS installment_id, p.number, i.premium
INTO policy_installment
FROM
    policy p
    RIGHT JOIN installment i ON i.policy_id = p.id;
    
SELECT
    policy_id, number, COUNT(installment_id), SUM(premium)
INTO installment_agregate
FROM
    policy_installment
GROUP BY policy_id,number;


SELECT policy_id AS id, number, sum FROM installment_agregate WHERE count>1;

-----------------------------------
Tworzenie tabel i dane przykładowe do fiddle:
CREATE TABLE policy (
id SERIAL PRIMARY KEY,
number VARCHAR(32) UNIQUE
);

CREATE TABLE installment (
id SERIAL PRIMARY KEY,
policy_id INT REFERENCES policy (id),
premium INT
);

INSERT INTO policy (number) VALUES ('fjkeorafDAWRF342Fs3F5d3ferAebsde'),('fjkeorafDAWRF342Fs3F5d3ferAebsdk'),('fjkeorafDAWRF342Fs3F5d3ferAebsdj'),('fjkeorafDAWRF342Fs3F5d3ferAebsdh'),('fjkeorafDAWRF342Fs3F5d3ferAebsdg'),('fjkeorafDAWRF342Fs3F5d3ferAebsdf'),('fjkeorafDAWRF342Fs3F5d3ferAebsdd'),('fjkeorafDAWRF342Fs3F5d3ferAebsdz');

INSERT INTO installment (policy_id, premium) VALUES (1,0),(1,1),(3,2),(4,1),(5,2),(6, 3),(7, 1),(8,2);

-----------------------------------
