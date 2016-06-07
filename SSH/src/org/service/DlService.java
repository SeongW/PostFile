package org.service;

import org.model.DlbEntity;

/**
 * Created by wujiacheng on 16/5/31.
 */
public interface DlService {
    public DlbEntity find(String xh,String kl);
    public boolean existXh(String xh);
    public void save(DlbEntity user);
}
