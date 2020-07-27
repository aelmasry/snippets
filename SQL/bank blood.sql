Select tb.BG,(tb2.AMOUNT - tb.AMOUNT) as AMOUNT FROM (
    Select Donor.BG, Sum(Donor.AMOUNT) as       
    AMOUNT
    FROM Donor group by Donor.BG
) as tb
LEFT JOIN (
    Select ACCEPTOR.BG, Sum(ACCEPTOR.AMOUNT)            as AMOUNT
        FROM ACCEPTOR group by ACCEPTOR.BG
) as tb2 on tb.BG = tb2.BG
order by tb.BG



Select shortages.Type, shortages.Shortage from (
    Select a.Type, a.QTY-d.QTY Shortage
    from 
        (Select Type, sum(QTY) QTY from Acceptors group by Type) a
         inner join 
        (Select Type, sum(QTY) QTY from Donors group by Type) d on a.type = d.type

) shortages
where shortages.shortage > 0