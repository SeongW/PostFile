package org.dao.imp;

import org.model.DlbEntity;
import org.omg.CORBA.PUBLIC_MEMBER;

/**
 * Created by wujiacheng on 16/5/31.
 */
public interface Dldao {
    public void save(DlbEntity dl);
    public DlbEntity find(String xh,String kl);
    public boolean existXh(String xh);
}
